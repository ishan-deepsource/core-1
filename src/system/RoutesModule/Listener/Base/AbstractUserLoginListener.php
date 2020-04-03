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

namespace Zikula\RoutesModule\Listener\Base;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula\UsersModule\Event\UserPostLoginFailureEvent;
use Zikula\UsersModule\Event\UserPostLoginSuccessEvent;
use Zikula\UsersModule\Event\UserPreLoginSuccessEvent;

/**
 * Event handler base class for user login events.
 */
abstract class AbstractUserLoginListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            UserPreLoginSuccessEvent::class => ['veto', 5],
            UserPostLoginSuccessEvent::class => ['succeeded', 5],
            UserPostLoginFailureEvent::class  => ['failed', 5]
        ];
    }

    /**
     * Listener for the `UserPreLoginSuccessEvent`.
     *
     * Occurs immediately prior to a log-in that is expected to succeed. (All prerequisites for a
     * successful login have been checked and are satisfied.) This event allows an extension to
     * intercept the login process and prevent a successful login from taking place.
     *
     * A handler that needs to veto a login attempt should call `stopPropagation()`.
     * This will prevent other handlers from receiving the event, will
     * return to the login process, and will prevent the login from taking place. A handler that
     * vetoes a login attempt should set an appropriate session flash message and give any additional
     * feedback to the user attempting to log in that might be appropriate.
     *
     * If vetoing the login, the 'returnUrl' property should be set to redirect the user to an appropriate action.
     * Also, a 'flash' property may be set to provide information to the user for the veto.
     *
     * Note: the user __will not__ be logged in at the point where the event handler is
     * executing. Any attempt to check a user's permissions, his logged-in status, or any
     * operation will return a value equivalent to what an anonymous (guest) user would see. Care
     * should be taken to ensure that sensitive operations done within a handler for this event
     * do not introduce breaches of security.
     */
    public function veto(UserPreLoginSuccessEvent $event): void
    {
    }

    /**
     * Listener for the `UserPostLoginSuccessEvent`.
     *
     * Occurs right after a successful attempt to log in, and just prior to redirecting the user to the desired page.
     *
     * If a `'returnUrl'` is specified by any entity intercepting and processing the event, then
     * the URL provided replaces the one provided by the returnUrl parameter to the login process. If it is set to an empty
     * string, then the user is redirected to the site's home page. An event handler should carefully consider whether
     * changing the `'returnUrl'` argument is appropriate. First, the user may be expecting to return to the page where
     * he was when he initiated the log-in process. Being redirected to a different page might be disorienting to the user.
     * Second, an event handler that was notified prior to the current handler may already have changed the `'returnUrl'`.
     *
     * Finally, this event only fires in the event of a "normal" UI-oriented log-in attempt. A module attempting to log in
     * programmatically by directly calling the login function will not see this event fired.
     */
    public function succeeded(UserPostLoginSuccessEvent $event): void
    {
    }

    /**
     * Listener for the `UserPostLoginFailureEvent`.
     *
     * Occurs right after an unsuccessful attempt to log in.
     *
     * The event contains the userEntity if it has been found, otherwise null.
     *
     * If a `'returnUrl'` is specified by any entity intercepting and processing this event, then
     * the user will be redirected to the URL provided.  An event handler
     * should carefully consider whether changing the `'returnUrl'` argument is appropriate. First, the user may be expecting
     * to return to the log-in screen . Being redirected to a different page might be disorienting to the user.
     * Second, an event handler that was notified prior to the current handler may already have changed the `'returnUrl'`.
     *
     * Finally, this event only fires in the event of a "normal" UI-oriented log-in attempt. A module attempting to log in
     * programmatically by directly calling core functions will not see this event fired.
     */
    public function failed(UserPostLoginFailureEvent $event): void
    {
    }
}
