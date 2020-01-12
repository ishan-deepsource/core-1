<?php

/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <info@ziku.la>.
 * @see https://ziku.la
 * @version Generated by ModuleStudio 1.4.0 (https://modulestudio.de).
 */

declare(strict_types=1);

namespace Zikula\RoutesModule\Base;

use Exception;
use Zikula\Core\AbstractExtensionInstaller;
use Zikula\RoutesModule\Entity\RouteEntity;

/**
 * Installer base class.
 */
abstract class AbstractRoutesModuleInstaller extends AbstractExtensionInstaller
{
    /**
     * @var string[]
     */
    protected $entities = [
        RouteEntity::class,
    ];

    public function install(): bool
    {
        // create all tables from according entity definitions
        try {
            $this->schemaTool->create($this->entities);
        } catch (Exception $exception) {
            $this->addFlash('error', $this->trans('Doctrine Exception') . ': ' . $exception->getMessage());
    
            return false;
        }
    
        // set up all our vars with initial values
        $this->setVar('routeEntriesPerPage', 10);
        $this->setVar('showOnlyOwnEntries', false);
        $this->setVar('allowModerationSpecificCreatorForRoute', false);
        $this->setVar('allowModerationSpecificCreationDateForRoute', false);
    
        // initialisation successful
        return true;
    }
    
    public function upgrade(string $oldVersion): bool
    {
    /*
        // upgrade dependent on old version number
        switch ($oldVersion) {
            case '1.0.0':
                // do something
                // ...
                // update the database schema
                try {
                    $this->schemaTool->update($this->entities);
                } catch (Exception $exception) {
                    $this->addFlash('error', $this->trans('Doctrine Exception') . ': ' . $exception->getMessage());
    
                    return false;
                }
        }
    */
    
        // update successful
        return true;
    }
    
    public function uninstall(): bool
    {
        try {
            $this->schemaTool->drop($this->entities);
        } catch (Exception $exception) {
            $this->addFlash('error', $this->trans('Doctrine Exception') . ': ' . $exception->getMessage());
    
            return false;
        }
    
        // remove all module vars
        $this->delVars();
    
        // uninstallation successful
        return true;
    }
}
