<?php
namespace Mprieto\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Framework\App\State;

class AddSampleBlogAndCustomer implements DataPatchInterface
{
    private $moduleDataSetup;
    private $customerRepository;
    private $customerFactory;
    private $state;

    public const WEBSITE_ID_DEFAULT = 1;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerRepositoryInterface $customerRepository,
        CustomerInterfaceFactory $customerFactory,
        State $state
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
        $this->state = $state;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        try {
            // En ambientes CLI puede ser necesario
            $this->state->setAreaCode('frontend');
        } catch (\Exception $e) {
            // El area code ya estaba seteada
        }
        
        $customerId = $this->getCustomerId();
        $blogId = $this->createBlogPost();
        $this->createComment($blogId, $customerId);

        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function getCustomerId()
    {
        $email = 'prieto.miguel0318@gmail.com';
        $websiteId = self::WEBSITE_ID_DEFAULT; 

        $customer = $this->customerFactory->create();
        $customer->setFirstname('Miguel');
        $customer->setLastname('Prieto');
        $customer->setEmail($email);
        $customer->setWebsiteId($websiteId);

        $customer = $this->customerRepository->save($customer, 'Developer0318.');

        return $customer->getId();
    }

    public function createBlogPost()
    {
        $connection = $this->moduleDataSetup->getConnection();

        $connection->insert(
            $this->moduleDataSetup->getTable('mprieto_blog'),
            [
                'name' => 'Primer post de ejemplo',
                'content' => 'Contenido del post de prueba',
                'is_active' => 1,
                'store_id' => self::WEBSITE_ID_DEFAULT,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );


        $blogId = $connection->lastInsertId(
            $this->moduleDataSetup->getTable('mprieto_blog')
        );

        return $blogId;
    }

    public function createComment($blogId, $customerId)
    {
        $this->moduleDataSetup->getConnection()->insertForce(
            $this->moduleDataSetup->getTable('mprieto_blog_comments'),
            [
                'blog_id' => $blogId,
                'customer_id' => $customerId,
                'comment' => 'Este es un comentario de prueba asociado al usuario creado.',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        );
    }   
}
