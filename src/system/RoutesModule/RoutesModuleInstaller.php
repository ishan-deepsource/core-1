<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.0 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule;

use Zikula\RoutesModule\Base\AbstractRoutesModuleInstaller;

/**
 * Installer implementation class.
 */
class RoutesModuleInstaller extends AbstractRoutesModuleInstaller
{
    /**
     * {@inheritdoc}
     */
    public function upgrade($oldVersion)
    {
        switch ($oldVersion) {
            case '1.0.0':
                // routes of system modules are not stored in database anymore
                $sql = '
                    DELETE FROM zikula_routes_route
                    WHERE userRoute = 0
                ';
                $this->entityManager->getConnection()->exec($sql);

                // update table to meet entity structure
                $this->schemaTool->update(['\Zikula\RoutesModule\Entity\RouteEntity']);
            case '1.0.1':
                // nothing
            case '1.1.0':
                // current version
        }

        return true;
    }
}
