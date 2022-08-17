<?php

namespace App\Form;

use App\Entity\FormPanel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FormPanelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('role', ChoiceType::class, [
                'choices' => array_combine(FormPanel::TYPE, FormPanel::TYPE)
            ])
            ->add('nip')
            ->add('pesel')
            ->add('phoneNumber')
            ->add('email', EmailType::class)
            ->add('streetAddress')
            ->add('localNumber')
            ->add('zipCode')
            ->add('correspondenceAddress')
            ->add('correspondenceLocalNumber')
            ->add('correspondenceZipCode')
            ->add('contactHours', ChoiceType::class, [
                'choices' => array_combine(FormPanel::CONTACT_HOURS, FormPanel::CONTACT_HOURS)
            ])
            ->add('topic', ChoiceType::class, [
                'choices' => array_combine(FormPanel::TOPIC, FormPanel::TOPIC)
            ])
            ->add('pdfFileName', FileType::class, [
                'label' => 'PDF file',
                'mapped' => false,
                'required' => false,
                'error_bubbling' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormPanel::class,
            'csrf_protection' => false
        ]);
    }
}
