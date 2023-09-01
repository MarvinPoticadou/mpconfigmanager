<?php

namespace Mp\Module\MpConfigManager\Form\Type;

use Mp\Module\MpConfigManager\Form\Model\ConfigData;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigType extends TranslatorAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idShopGroup', TextType::class, [
                'required' => false,
                'label' => 'ID Shop Group',
            ])
            ->add('idShop', TextType::class, [
                'required' => false,
                'label' => 'ID Shop',
            ])
            ->add('name', TextType::class, [
                'required' => false,
                'label' => $this->trans('Name', 'Modules.Mpconfigmanager.Admin'),
            ])
            ->add('value', TextType::class, [
                'required' => false,
                'label' => $this->trans('Value', 'Modules.Mpconfigmanager.Admin'),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigData::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'module_mpconfigmanager';
    }
}
