<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 2/12/2019
 * Time: 8:57 PM
 */

namespace EvenementBundle\Listener;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use AppBundle\Entity\CalendarEvent as MyCustomEvent;
use AppBundle\Entity\CalendarEvent;

class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDate();
        $endDate = $calendarEvent->getEndDate();


        //You may want do a custom query to populate the events

        $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
        $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));

        $calendarEvent->setAllDay(true);
    }

}