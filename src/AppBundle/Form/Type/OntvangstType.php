<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OntvangstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   

        $builder
            ->add('ontvangstdatum', DateType::class, array(
                'format' => 'dd-MM-yyyy'))
        ;
        $builder
            ->add('hoeveelheid', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('kwaliteit', ChoiceType::class, array(
    'choices'  => array(
        'Goed' => 'Goed',
        'Slecht' => 'Slecht',
    ),
));
        $builder
            ->add('bestelordernummer', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('omschrijving', TextType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('leveranciersnaam', TextType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder->add('afgekeurd', ChoiceType::class, array(
            'choices'  => array(
                'Ja' => true,
                'Nee' => false
            ),
        ));

        $builder
            ->add('ontvangen', ChoiceType::class, array(
            'choices'  => array(
                'Ja' => true,
                'Nee' => false
            ),
        ));
        

        //zie
        //http://symfony.com/doc/current/forms.html#built-in-field-types
        //voor meer typen invoer
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ontvangst', //Entiteit vervangen door b.v. Klant
        ));
    }
}

?>