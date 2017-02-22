<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.4 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Form\Type\Field\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zikula\RoutesModule\Form\DataTransformer\ListFieldTransformer;
use Zikula\RoutesModule\Helper\ListEntriesHelper;

/**
 * Multi list field type base class.
 */
abstract class AbstractMultiListType extends AbstractType
{
    /**
     * @var ListEntriesHelper
     */
    protected $listHelper;

    /**
     * MultiListType constructor.
     *
     * @param ListEntriesHelper $listHelper ListEntriesHelper service instance
     */
    public function __construct(ListEntriesHelper $listHelper)
    {
        $this->listHelper = $listHelper;
    }

    /**
* @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ListFieldTransformer($this->listHelper);
        $builder->addModelTransformer($transformer);
    }

    /**
* @inheritDoc
     */
    public function getParent()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\ChoiceType';
    }

    /**
* @inheritDoc
     */
    public function getBlockPrefix()
    {
        return 'zikularoutesmodule_field_multilist';
    }
}
