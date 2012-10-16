<?php

namespace Iluni\BookBundle\Form\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Form type for used with CRUD controller (entity operation)
 *
 * @author E.R. Nurwijayadi <epsi.rns@gmail.com>
 */
class ADegreesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $query_builder = function (EntityRepository $repository) {
            return $repository->createQueryBuilder('r')->orderBy('r.id');
        };

        $builder
            ->add('strata', 'entity', array(
                'class' => 'Iluni\BookBundle\Entity\Category\Strata',
                'property' => 'name',
                'query_builder' => $query_builder,
                // 'preferred_choices' => array(10) // hardcoded default value
            ))
            ->add('admitted')
            ->add('graduated')

            // Set default here, as alternate of setting in entity constructor
            ->add('degree')
            ->add('institution')
            ->add('major')
            ->add('minor')
            ->add('concentration');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain'     => 'forms',
        ));
    }

    public function getName()
    {
        return 'iluni_bookbundle_adegreestype';
    }
}

