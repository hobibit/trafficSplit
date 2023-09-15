<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\TrafficSplitEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrafficSplitForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chucklePayWeight', TextType::class)
            ->add('cosmicPayWeight', TextType::class)
            ->add('giggleGuardWeight', TextType::class)
            ->add('witWalletWeight', TextType::class)
            ->add('execute', SubmitType::class, ['label' => 'Execute 100 Payments'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrafficSplitEntity::class,
        ]);
    }
}
