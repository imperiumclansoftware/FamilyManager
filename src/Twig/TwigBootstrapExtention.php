<?php

/*
 * Mes propres Filtres Twigs
 *
 * Voir  aussi dans services.yaml
 */


# add more service definitions when explicit configuration is needed
# please note that last definitions always *replace* previous ones

# Mon filtre Twig
#   Exemple :
#           {{ "trucBidulle"|badge }}
#           {{ "trucBidulle"|badge({'color': 'danger'}) }}
#           {{ "trucBidulle"|badge({'color': 'danger', 'rounded': true}) }}
#
#   il y a aussi un filtren pour les booleans
#    {{ "trucBidulle"|booleanBadge({'trueText': 'Cest OK', 'falseText': 'C est KO'}) }}
#
#   euro pour mettre le symbole €
#


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Description of TwigBootstrapExtention
 *
 * Tous mes filtres twig que j'ai fait
 *
 * @author Philippe Basuyau
 */
class TwigBootstrapExtention extends AbstractExtension
{

    //--- Mon tableau qui rertourne mes filtres
    public function getFilters()
    {

        return [
            new TwigFilter('E', [$this, 'euroFilter'], ['is_safe' => ['html']]),
            new TwigFilter('badge', [$this, 'badgeFilter'], ['is_safe' => ['html']]),
            new TwigFilter('booleanBadge', [$this, 'booleanBadgeFilter'], ['is_safe' => ['html']])
        ];
    }

    //--- fin de la fonction getFilters

    public function euroFilter($content): string
    {

        return $content . ' €';
    }   //--- fin de la fonction euroBadge


    /**
     * BadgeFilter
     * Permet de mettre un span badge
     * La couleur de default est primary
     * on peut changer cette couleur avec cette écriture:
     *    {{ "trucBidulle"|badge }}
     *    {{ "trucBidulle"|badge({'color': 'danger'}) }}
     *    {{ "trucBidulle"|badge({'color': 'danger', 'rounded': true}) }}
     *
     * @param type $content
     * @param array $options
     * @return string
     */
    public function badgeFilter($content, array $options = []): string
    {

        $defaultOptions = [
            'color' => 'primary',
            'rounded' => false
        ];

        $options = array_merge($defaultOptions, $options);

        $color = $options['color'];
        $pill = $options['rounded'] ? " badge-pill" : "";

        $template = '<span class="badge badge-%s %s">%s</span>';

        //         return '<span class="badge badge-' . $color . ' ' . $pill . '">' . $content . '</span> ';

        return sprintf(
            $template,
            $color,
            $pill,
            $content
        );
    }

    //--- fin de la fonction badgeFilter



    /**
     * BadgeFilter Spécial BOOLEAN
     * Permet de mettre un span badge sur un Boolean
     * La couleur de default est primary
     * on peut changer cette couleur avec cette écriture:
     *    {{ "trucBidulle"|booleanBadge }}
     *    {{ "trucBidulle"|booleanBadge({'trueText': 'Cest OK', 'falseText': 'C est KO'}) }}
     * @param bool $content
     * @param array $options
     * @return string
     */
    public function booleanBadgeFilter(bool $content, array $options = []): string
    {

        $defaultOptions = [
            'trueText' => 'Oui',
            'falseText' => 'Non'
        ];

        $options = array_merge($defaultOptions, $options);

        if ($content) {
            return $this->badgeFilter($options['trueText']);
        } else {
            return $this->badgeFilter($options['falseText'], ['color' => 'danger']);
        }
    }

    //--- fin de la fonctio n booleanBadgeFilter

}

//--- fin de la classe TwigBootstrapExtentions
