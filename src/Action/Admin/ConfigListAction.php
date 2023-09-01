<?php

namespace Mp\Module\MpConfigManager\Action\Admin;

use Mp\Module\MpConfigManager\Search\ConfigFilters;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Response;

class ConfigListAction extends FrameworkBundleAdminController
{
    public function __invoke(): Response
    {
        $gridFactory = $this->get('mp.module.mpconfigmanager.grid.factory.config');

        $grid = $this->presentGrid($gridFactory->getGrid(ConfigFilters::buildDefaults()));

        return $this->render('@Modules/mpconfigmanager/templates/admin/list.html.twig', [
            'grid' => $grid,
            'layoutHeaderToolbarBtn' => $this->getToolbarButtons(),
            'layoutTitle' => $this->trans('Config', 'Modules.Mpconfigmanager.Admin'),
        ]);
    }

    private function getToolbarButtons(): array
    {
        return [
            'add' => [
                'href' => $this->generateUrl('admin_mpconfigmanager_create'),
                'desc' => $this->trans('New configuration', 'Modules.Mpconfigmanager.Admin'),
                'icon' => 'add_circle_outline',
            ],
        ];
    }
}
