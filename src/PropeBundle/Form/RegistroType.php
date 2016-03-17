<?php

namespace PropeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('correo')
            ->add('ciudad')
            ->add('institucion')
            ->add('estado')
            ->add('curso', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
            'choices'  => array(
                'Introducción a la Física Matemática, José Antonio Zapata.' => 'Curso 3 - Introducción a la Física Matemática, José Antonio Zapata.',
                'Tópicos en combinatoria, María Luisa Pérez.' => 'Curso 3 - Tópicos en combinatoria, María Luisa Pérez.',
            ),
                'choices_as_values' => true,
            ))
            ->add('intencion', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array())
            ->add('beca',   'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'hospedaje, alimentación y traslados' => 'hospedaje, alimentación y traslados',
                    'Solo alimentación' => 'Solo alimentación',
                ),
                'choices_as_values' => true,
            ))
        ;

        $builder->add('kardexFile', 'vich_file', array(
            'label' => 'Archivo de Kardex',
            'required'      => true,
        ));

        $builder->add('recomendacionFile', 'vich_file', array(
            'label' => 'Archivo de recomendación de un profesor',
            'required'      => true,
        ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PropeBundle\Entity\Registro'
        ));
    }
}
