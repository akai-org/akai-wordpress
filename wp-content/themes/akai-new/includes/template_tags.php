<?php

/**
 * prints Google Add to calendar link
 * more info: http://stackoverflow.com/questions/10488831/link-to-add-to-google-calendar
 * @param int $duration in seconds
 *
 * @todo czy to ma byc link Add to calendar, czy moze jakis obiekt, ktory mozna dodawac takze do innych kalendarzy?
 *   np. plik .iCal
 *   http://www.phpclasses.org/package/873-PHP-Class-for-creating-iCalendar-files.html
 *   http://stackoverflow.com/questions/1661478/add-an-outlook-calendar-event-from-a-link-on-a-web-page
 *   http://www.myhow2guru.com/archives/php-generate-calendar-file-ics/
 *   lub plik .vcs od outlooka (buehehehe; u're kidding right?) http://www.terminally-incoherent.com/blog/2008/04/14/generate-outlook-calendar-events-with-php-and-icalendar/
 */
function akai_add_to_calendar_url($duration = 5400) {
  $start_timestamp = get_field('event_date');
  if (!$start_timestamp) {
    return;
  }

  // Stupid hack to fix time set on Google Calendar.
  // Even if you pass the 18:30 time to Google and a timezone, it will convert the time to its current timezone anyway (thus, making 20:30 from it, if we're in Warsaw (2 hours between UTC and Europe/Warsaw))
  $hours_offset = 2;
  // if (date_i18n('I')) {
    $hours_offset -= 1;
  // }
  $start_timestamp -= $hours_offset * 60 * 60;

  $end_timestamp = $start_timestamp + $duration;

  $params = [
    'text' => get_the_title(),
    'dates' => date_i18n('Ymd\THis\Z', $start_timestamp) . '/' . date_i18n('Ymd\THis\Z', $end_timestamp),
    'details' => "Opis wydarzenia: " . get_permalink(),
    'location' => get_field('location') ? get_field('location')['address'] : null,
    // 'ctz' => date_i18n('e') # timezone
    'ctz' => "Europe/Warsaw"
    // 'sprop' => get_permalink()
  ];

  // var_dump($params);
  // die();

  $url_params = '';
  foreach ($params as $key => $value) {
    if ($value) {
      $key = urlencode($key);
      $value = urlencode($value);
      $url_params .= "&{$key}={$value}";
    }
  }

  return "http://www.google.com/calendar/event?action=TEMPLATE&sprop=". get_permalink() ."&sprop=name:AKAI" . $url_params;
}


/**
 * Show horizontal photo, f.e. on page or post's page.
 * @return void
 */
function akai_the_horizontal_photo()
{
  $horizontal_photo_url = get_field('horizontal_photo');
  if ($horizontal_photo_url) {
    printf('<div class="horizontal-photo" style="background-image:url(%s)"></div>', $horizontal_photo_url);
  }
}
