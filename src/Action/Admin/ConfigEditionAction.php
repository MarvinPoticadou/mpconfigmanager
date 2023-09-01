<?php

namespace Mp\Module\MpConfigManager\Action\Admin;

use Mp\Module\MpConfigManager\Entity\Config;
use Mp\Module\MpConfigManager\Form\Model\ConfigData;
use Mp\Module\MpConfigManager\Form\Type\ConfigType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigEditionAction extends FrameworkBundleAdminController
{
    public function __invoke(Request $request, int $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Config $config */
        $config = $em->getRepository(Config::class)->find($id);

        if (!$config) {
            throw $this->createNotFoundException('Config not found');
        }

        $configData = new ConfigData($config);
        $form = $this->createForm(ConfigType::class, $configData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $config = (new Config())
                ->setIdShopGroup($configData->idShopGroup)
                ->setIdShop($configData->idShop)
                ->setName($configData->name)
                ->setValue($configData->value);

            $em->persist($config);
            $em->flush();

            $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

            return $this->redirectToRoute('admin_mpconfigmanager_list');
        }

        return $this->render('@Modules/mpconfigmanager/templates/admin/form.html.twig', [
            'form' => $form->createView(),
            'layoutTitle' => $this->trans('Config', 'Modules.Mpconfigmanager.Admin'),
        ]);
    }
}
