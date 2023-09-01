<?php

namespace Mp\Module\MpConfigManager\Action\Admin;

use Mp\Module\MpConfigManager\Entity\Config;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigDeletionAction extends FrameworkBundleAdminController
{
    public function __invoke(Request $request, int $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Config $config */
        $config = $em->getRepository(Config::class)->find($id);

        if (!$config) {
            throw $this->createNotFoundException('Config not found');
        }

        $em->remove($config);
        $em->flush();

        $this->addFlash('success', $this->trans('Successful deletion.', 'Admin.Notifications.Success'));

        return $this->redirectToRoute('admin_mpconfigmanager_list');
    }
}
