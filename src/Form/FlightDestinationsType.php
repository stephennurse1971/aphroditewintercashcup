<?php

namespace App\Form;

use App\Entity\Airports;
use App\Entity\FlightDestinations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlightDestinationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['mode'] == 'new') {
            $builder
                ->add('departureCity', EntityType::class, [
                    'class' => Airports::class,
                    'choice_label' => 'city',
                    'required' => true,
                    'empty_data' => null,
                    'data' => $options['oac']
                ])
                ->add('arrivalCity', EntityType::class, [
                    'class' => Airports::class,
                    'choice_label' => 'city',
                    'required' => true,
                    'empty_data' => null,
                    'data' => $options['odc']
                ])
                ->add('dateStart', DateType::class, [
                    'label' => 'Start date',
                    'widget' => 'single_text',
                    'required' => false,
                    'data' => $options['ods']
                ])
                ->add('dateEnd', DateType::class, [
                    'label' => 'End date',
                    'widget' => 'single_text',
                    'required' => false,
                    'data' => $options['ode']
                ])
                ->add('grouping', TextType::class, [
                        'label' => 'grouping',
                        'data' => $options['ogrouping'],
                        'required' => false,
                    ]
                )
                ->add('adminOnly', ChoiceType::class, [
                    'label' => 'Admin Only',
                    'choices' => [
                        'Yes' => true,
                        'No' => false
                    ],
                    'required' => false,
                    'data' => $options['oadmin']
                ])
                ->add('isActive', ChoiceType::class, [
                    'label' => 'Active',
                    'choices' => [
                        'Yes' => true,
                        'No' => false
                    ],
                    'required' => false,
                    'data' => $options['oisactive']
                ])
                ->add('returnLeg', ChoiceType::class, [
                    'label' => 'Outbound or Return',
                    'required' => false,
                    'data'=>'Return',
                    'choices' => [
                        'Outbound' => 'Outbound',
                        'Return' => 'Return'
                    ]
                ]);
        } else {
            $builder
                ->add('departureCity', EntityType::class, [
                    'class' => Airports::class,
                    'choice_label' => 'city',
                    'required' => true,
                    'empty_data' => null,
                ])
                ->add('arrivalCity', EntityType::class, [
                    'class' => Airports::class,
                    'choice_label' => 'city',
                    'required' => true,
                    'empty_data' => null,
                ])
                ->add('dateStart', DateType::class, [
                    'label' => 'Start date',
                    'widget' => 'single_text',
                    'required' => false,
                ])
                ->add('dateEnd', DateType::class, [
                    'label' => 'End date',
                    'widget' => 'single_text',
                    'required' => false,
                ])
                ->add('grouping')
                ->add('adminOnly')
                ->add('isActive')
                ->add('returnLeg', ChoiceType::class, [
                    'label' => 'Outbound or Return',
                    'required' => false,
                    'choices' => [
                        'Outbound' => 'Outbound',
                        'Return' => 'Return'
                    ]
                ])
            ;
        }
        $builder

            ->add('lastScraped', DateType::class, [
                'label' => 'Last Scraped',
                'widget' => 'single_text',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FlightDestinations::class,
            'odc' => null,
            'oac' => null,
            'ods' => null,
            'ode' => null,
            'oadmin' => null,
            'oisactive' => null,
            'ogrouping' => null,
            'rt' => null,
            'mode' => null
        ]);
    }
}
