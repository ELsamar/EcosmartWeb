<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Validator\Constraints\File;
use Gregwar\CaptchaBundle\Type\CaptchaType;
class RegistrationFormType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('label'=>'nom'))
            ->add('prenom',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('label'=>'prenom'))
            ->add('imageprofile','Symfony\Component\Form\Extension\Core\Type\FileType',array('required'=>false))
        ->add('roles',ChoiceType::class,array(
        'label' => 'Type',
        'choices'=>array(
            'COLLECTEUR'=>'ROLE_COLLECTEUR',
            'RECYCLEUR'=>'ROLE_RECYCLEUR',
            'CITOYEN'=>'ROLE_CITOYEN'),

        'required'=> true , 'multiple'=>true,'expanded'=>false,

    ))
            ->add('captcha', CaptchaType::class);


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }




    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


}