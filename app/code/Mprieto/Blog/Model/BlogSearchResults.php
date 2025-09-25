<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mprieto\Blog\Model;

use Mprieto\Blog\Api\Data\BlogSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Page search results.
 */
class BlogSearchResults extends SearchResults implements BlogSearchResultsInterface
{
}
