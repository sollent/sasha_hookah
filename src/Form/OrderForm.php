<?php

namespace App\Form;

use App\Model\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class OrderForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('count', IntegerType::class)
            ->add('insiderCity', CheckboxType::class)
//            ->add('outsideCity', CheckboxType::class)
            ->add('countAdditionalMixes', IntegerType::class)
            ->add('phoneNumber', TextType::class)
            ->add('address', TextType::class)
            ->add('date', TextType::class)
            ->add('time', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class
        ]);
    }

}