<?php
namespace Mp\Module\MpConfigManager\Grid\Definition\Factory;

use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollectionInterface;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DateTimeColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;

class ConfigDefinitionFactory extends AbstractGridDefinitionFactory
{
    protected function getId(): string
    {
        return 'config';
    }

    protected function getName(): string
    {
        return $this->trans('Config', [], 'Modules.Mpconfigmanager.Admin');
    }

    protected function getColumns(): ColumnCollectionInterface
    {
        return (new ColumnCollection())
            ->add(
                (new DataColumn('id'))
                    ->setName($this->trans('ID', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'id_configuration',
                    ])
            )
            ->add(
                (new DataColumn('idShopGroup'))
                    ->setName($this->trans('ID Shop Group', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'id_shop_group',
                    ])
            )
            ->add(
                (new DataColumn('idShop'))
                    ->setName($this->trans('ID Shop', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'id_shop',
                    ])
            )
            ->add(
                (new DataColumn('name'))
                    ->setName($this->trans('Name', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'name',
                    ])
            )
            ->add(
                (new DataColumn('value'))
                    ->setName($this->trans('Value', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'value',
                    ])
            )
            ->add(
                (new DateTimeColumn('date_add'))
                    ->setName($this->trans('Created at', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'date_add',
                        'format' => 'd/m/Y H:i:s'
                    ])
            )
            ->add(
                (new DateTimeColumn('date_upd'))
                    ->setName($this->trans('Updated at', [], 'Admin.Global'))
                    ->setOptions([
                        'field' => 'date_upd',
                        'format' => 'd/m/Y H:i:s'
                    ])
            )
            ->add(
                (new ActionColumn('actions'))
                    ->setOptions([
                        'actions' => (new RowActionCollection())
                            ->add(
                                (new LinkRowAction('edit'))
                                    ->setIcon('edit')
                                    ->setOptions([
                                        'route' => 'admin_mpconfigmanager_edit',
                                        'route_param_name' => 'id',
                                        'route_param_field' => 'id_configuration',
                                    ])
                            )
                            ->add(
                                (new SubmitRowAction('delete'))
                                    ->setName($this->trans('Delete', [], 'Admin.Actions'))
                                    ->setIcon('delete')
                                    ->setOptions([
                                        'route' => 'admin_mpconfigmanager_delete',
                                        'route_param_name' => 'id',
                                        'route_param_field' => 'id_configuration',
                                        'confirm_message' => $this->trans('Delete selected item?', [], 'Admin.Notifications.Warning'),
                                    ])
                            ),
                    ])
            );
    }
}
