<?php
namespace Mp\Module\MpConfigManager\Grid\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Query\AbstractDoctrineQueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;

class ConfigQueryBuilder extends AbstractDoctrineQueryBuilder
{
    public function getSearchQueryBuilder(SearchCriteriaInterface $searchCriteria): QueryBuilder
    {
        $qb = $this->getQueryBuilder($searchCriteria)
            ->select('*')
            ->orderBy($searchCriteria->getOrderBy(), $searchCriteria->getOrderWay());

        if ($searchCriteria->getLimit() > 0) {
            $qb
                ->setFirstResult($searchCriteria->getOffset())
                ->setMaxResults($searchCriteria->getLimit());
        }

        return $qb;
    }

    public function getCountQueryBuilder(SearchCriteriaInterface $searchCriteria): QueryBuilder
    {
        return $this->getQueryBuilder($searchCriteria)->select('COUNT(s.id_configuration)');
    }

    private function getQueryBuilder(SearchCriteriaInterface $searchCriteria): QueryBuilder
    {
        $qb = $this->connection->createQueryBuilder()
            ->from($this->dbPrefix . 'configuration', 's');

        foreach ($searchCriteria->getFilters() as $name => $value) {
            $qb
                ->andWhere(sprintf('s.%s LIKE :%s', $name, $name))
                ->setParameter($name, '%' . $value . '%');
        }

        return $qb;
    }
}
