<?php

namespace App\Form;

use App\Entity\Medias\FamilyImage;
use App\Entity\User;
use Liip\ImagineBundle\Form\Type\ImageType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $typeRole = [
            'administrateur' => 'ROLE_ADMIN',
            'Super Administrateur' => 'ROLE_SUPER_ADMIN',
            'utilisateur' => 'ROLE_USER',
        ];

        $user = $builder->getData();

        $usernameopt = array(
            'attr' => array(
                'placeholder' => 'Unique account identifier',
            ),
        );
        if ($user->getId() != null) {
            $usernameopt = array(
                'attr' => array(
                    'disabled' => 'disabled',
                ),
                'help' => 'Identifiant unique',
            );
        }

        $imagePath = "";

        if ($user->getAvatar() != null) {
            $imagePath = $user->getAvatar()->getFilePath();
        }

        $builder
            ->add('username', TextType::class, $usernameopt)
            ->add('roles', ChoiceType::class, array(
                'choices' => $typeRole,
                'label' => false,
                'label_attr' => array('class' => 'checkbox-inline curss'),
                'multiple' => true,
                'expanded' => true,
                'attr' => array('class' => 'checkbox-inline '),
                'required' => true
            ))
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password']
            ])
            ->add('name', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Name of user',
                ),

            ))
            ->add('surname', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Surname of user',
                ),

            ))
            ->add('email', EmailType::class, array(
                'label' => 'email',
                'attr' => array(
                    'placeholder' => 'Email of user format user@example.com',
                ),

            ))
            ->add('avatar', ImageType::class, [
                'label' => "Choisir l'avatar",
                'data_class' => null,
                'image_filter' => 'uploaderThumb',
                'image_path' => $imagePath,
                'image_attr' => array(
                    'class' => 'rounded-circle',
                ),
                'required' => false,
            ])
            ->add('submit', SubmitType::class, array(
                'label' => 'Valider',
                'attr' => array(
                    'class' => 'btn-success',
                ),
            ))

            ->get('avatar')
            ->addModelTransformer(new CallbackTransformer(
                function ($AImageasFile) {
                    if ($AImageasFile == null) {
                        return null;
                    }

                    $toto = new File($AImageasFile->getFilePath());
                    return $toto;
                },
                function (UploadedFile $fileasAImage) {
                    $profilePicPath = $this->container->getParameter('kernel.project_dir') . '/public/files/images/userProfilePic/';
                    $aimage = new FamilyImage($profilePicPath);

                    if ($fileasAImage != null) {

                        $aimage->LoadFile($fileasAImage, true, $fileasAImage->getClientOriginalName());
                    }

                    return $aimage;
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
