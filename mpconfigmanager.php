<?php

require_once __DIR__ . '/vendor/autoload.php';

use Mp\Module\MpConfigManager\Core\Module as MpModule;
use Mp\Module\MpConfigManager\Entity\Config;
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShopBundle\Entity\Repository\TabRepository;

if (!defined('_PS_VERSION_')) {
    exit;
}

class MpConfigManager extends MpModule implements WidgetInterface
{
    public function __construct()
    {
        $this->author = 'Marvin POTICADOU';
        $this->name = 'mpconfigmanager';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = ['min' => '1.7.6', 'max' => _PS_VERSION_];

        parent::__construct();

        $this->displayName = $this->trans('MpConfigManager', [], 'Modules.Mpconfigmanager.Admin');
        $this->description = $this->trans('Allow to manage configuration variables', [], 'Modules.Mpconfigmanager.Admin');
    }

    public function install(): bool
    {
        return parent::install() && $this->installTab();
    }

    public function uninstall()
    {
        return parent::uninstall()
            && $this->uninstallTab()
            ;
    }

    public function enable($force_all = false)
    {
        return parent::enable($force_all)
            && $this->installTab()
            ;
    }

    public function disable($force_all = false)
    {
        return parent::disable($force_all)
            && $this->uninstallTab()
            ;
    }

    private function installTab()
    {
        $tabRepository = $this->get('prestashop.core.admin.tab.repository');
        $tabId = (int) $tabRepository->findOneIdByClassName('MpConfigManagerController');
        if (!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->active = 1;
        $tab->class_name = 'MpConfigManagerController';
        $tab->route_name = 'admin_mpconfigmanager_list';
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = $this->trans('Configuration', array(), 'Modules.Mpconfigmanager.Admin', $lang['locale']);
        }
        $tab->id_parent = (int) $tabRepository->findOneIdByClassName('CONFIGURE');
        $tab->module = $this->name;

        return $tab->save();
    }

    private function uninstallTab()
    {
        $tabRepository = $this->get('prestashop.core.admin.tab.repository');
        $tabId = (int) $tabRepository->findOneIdByClassName('MpConfigManagerController');
        if (!$tabId) {
            return true;
        }

        $tab = new Tab($tabId);

        return $tab->delete();
    }

    public function getContent(): void
    {
        Tools::redirectAdmin($this->context->link->getAdminLink(null, true, [
            'route' => 'admin_mpconfigmanager_list',
        ]));
    }

    public function renderWidget($hookName, array $configuration): string
    {
        if (!$this->isEnabledForShopContext()) {
            return '';
        }
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        return $this->fetch('module:mpconfigmanager/templates/front/config.tpl');
    }

    public function getWidgetVariables($hookName, array $configuration): array
    {
        $container = $this->context->controller->getContainer();

        $entityManager = $container->get('doctrine.orm.entity_manager');

        $configs = $entityManager->getRepository(Config::class)->findAll();

        if (!$configs) {
            return [];
        }
        return [
            'configs' => $configs,
            'lang' => $this->context->language->id,
        ];
    }
}
