<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.1 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Entity;

use Zikula\RoutesModule\Entity\Base\AbstractRouteEntity as BaseEntity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DoctrineExtensions\StandardFields\Mapping\Annotation as ZK;
use ServiceUtil;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity class that defines the entity structure and behaviours.
 *
 * This is the concrete entity class for route entities.
 * @ORM\Entity(repositoryClass="\Zikula\RoutesModule\Entity\Repository\RouteRepository")
 * @ORM\Table(name="zikula_routes_route",
 *     indexes={
 *         @ORM\Index(name="workflowstateindex", columns={"workflowState"})
 *     }
 * )
 */
class RouteEntity extends BaseEntity
{
    const POSITION_FIXED_TOP = 3;

    const POSITION_MIDDLE = 5;

    const POSITION_FIXED_BOTTOM = 7;

    /**
* @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        // Always add route to the end of the list.
        $this->sort = -1;
    }

    /**
     * Returns the route's path prepended with the bundle prefix.
     *
     * @param null $container Used to set the container for ServiceUtil in case it is not already set
     *
     * @return string
     */
    public function getPathWithBundlePrefix($container = null)
    {
        if (isset($this->options['zkNoBundlePrefix']) && $this->options['zkNoBundlePrefix']) {
            // return path only
            return $this->path;
        }

        $bundle = $this->getBundle();

        if (!ServiceUtil::hasContainer()) {
            ServiceUtil::setContainer($container);
        }

        // return path prepended with bundle prefix
        return '/' . $bundle->getMetaData()->getUrl() . $this->path;
    }
}
