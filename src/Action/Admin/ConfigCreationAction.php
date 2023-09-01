<?php


namespace Mp\Module\MpConfigManager\Action\Admin;


use DateTime;
use Mp\Module\MpConfigManager\Entity\Config;
use Mp\Module\MpConfigManager\Form\Model\ConfigData;
use Mp\Module\MpConfigManager\Form\Type\ConfigType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigCreationAction extends FrameworkBundleAdminController
{
    public function __invoke(Request $request): Response
    {
        $configData = new ConfigData();
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

            $this->addFlash('success', $this->trans('Successful creation.', 'Admin.Notifications.Success'));

            return $this->redirectToRoute('admin_mpconfigmanager_list');
        }

        return $this->render('@Modules/mpconfigmanager/templates/admin/form.html.twig', [
            'form' => $form->createView(),
            'layoutTitle' => $this->trans('Configs', 'Modules.Mpconfigmanager.Admin'),
        ]);
    }
}
