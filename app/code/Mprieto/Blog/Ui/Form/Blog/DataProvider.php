<?php declare(strict_types=1);

namespace Mprieto\Blog\Ui\Form\Blog;

use Mprieto\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Mprieto\Blog\Model\ResourceModel\Blog\Grid\Collection;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    private array $loadedData = [];


    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        protected \Magento\Framework\App\RequestInterface $request,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * @return array
     */
    public function getData()
    {
        /*
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
            
        $items = $this->collection->getItems();
*/
        
        /** @var \Mprieto\Blog\Model\Blog $blog */
        /*
        foreach ($items as $blog) {
            $this->loadedData[$blog->getId()] = $blog->getData();
        }

        $data = $this->dataPersistor->get('mprieto_blog_blog');
        if (!empty($data)) {
            $blog = $this->collection->getNewEmptyItem();
            $blog->setData($data->getData());
            $this->loadedData[$blog->getId()] = $blog->getData();
            $this->dataPersistor->clear('mprieto_blog_blog');
        }

        return $this->loadedData;
        */
        

        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $blogId = $this->request->getParam('blog_id'); // viene de la URL

        if ($blogId) {
            $blog = $this->collection->getItemById($blogId);
            if ($blog) {
                $this->loadedData[$blog->getId()] = $blog->getData();
            }
        }

        // Caso: datos persistidos tras un error de guardado
       /* 
        $data = $this->dataPersistor->get('mprieto_blog_blog');
        if (!empty($data)) {
            $blog = $this->collection->getNewEmptyItem();
            $blog->setData($data);
            $this->loadedData[$blog->getId()] = $blog->getData();
            $this->dataPersistor->clear('mprieto_blog_blog');
        }
            
        */
        return $this->loadedData;
        
    }
}
