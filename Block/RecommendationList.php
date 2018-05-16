<?php
namespace IFlair\LahrerladenHomeRecommendation\Block;

/*
* A block to display recommendation list with custom template
*/
class RecommendationList extends \Magento\CatalogWidget\Block\Product\ProductsList
{
	public function createCollection()
	{
		/** @var $collection \Magento\Catalog\Model\ResourceModel\Product\Collection */
		$collection = $this->productCollectionFactory->create();
		$collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());
		
		$collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter();

		$conditions = $this->getConditions();
        $conditions->collectValidatedAttributes($collection);
        $this->sqlBuilder->attachConditionToCollection($collection, $conditions);
		
		return $collection;
	}
}