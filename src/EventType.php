<?php
namespace ContactHub;

final class EventType
{
    use IsValidConstant;

    const ABANDONED_CART = 'abandonedCart';
    const ADDED_COMPARE = 'addedCompare';
    const ADDED_PRODUCT = 'addedProduct';
    const ADDED_WISHLIST = 'addedWishlist';
    const CAMPAIGN_BLACKLISTED = 'campaignBlacklisted';
    const CAMPAIGN_BOUNCED = 'campaignBounced';
    const CAMPAIGN_LINK_CLICKED = 'campaignLinkClicked';
    const CAMPAIGN_MARKED_SPAM = 'campaignMarkedSpam';
    const CAMPAIGN_OPENED = 'campaignOpened';
    const CAMPAIGN_SENT = 'campaignSent';
    const CAMPAIGN_SUBSCRIBED = 'campaignSubscribed';
    const CAMPAIGN_UNSUBSCRIBED = 'campaignUnsubscribed';
    const CHANGED_SETTING = 'changedSetting';
    const CLICKED_LINK = 'clickedLink';
    const CLOSED_TICKET = 'closedTicket';
    const COMPLETED_ORDER = 'completedOrder';
    const EVENT_CONFIRMED = 'eventConfirmed';
    const EVENT_DECLINED = 'eventDeclined';
    const EVENT_ELIGIBLE = 'eventEligible';
    const EVENT_INVITED = 'eventInvited';
    const EVENT_NOT_SHOW = 'eventNotShow';
    const EVENT_NOT_INVITED = 'eventNotInvited';
    const EVENT_PARTICIPATED = 'eventParticipated';
    const FORM_COMPILED = 'formCompiled';
    const GENERIC_ACTIVE_EVENT = 'genericActiveEvent';
    const GENERIC_PASSIVE_EVENT = 'genericPassiveEvent';
    const LOGGED_IN = 'loggedIn';
    const LOGGED_OUT = 'loggedOut';
    const OPENED_TICKET = 'openedTicket';
    const ORDER_SHIPPED = 'orderShipped';
    const REMOVED_COMPARE = 'removedCompare';
    const REMOVED_PRODUCT = 'removedProduct';
    const REMOVED_WISHLIST = 'removedWishlist';
    const REPLIED_TICKET = 'repliedTicket';
    const REVIEWED_PRODUCT = 'reviewedProduct';
    const SEARCHED = 'searched';
    const SERVICE_SUBSCRIBED = 'serviceSubscribed';
    const SERVICE_UNSUBSCRIBED = 'serviceUnsubscribed';
    const VIEWED_PAGE = 'viewedPage';
    const VIEWED_PRODUCT = 'viewedProduct';
}