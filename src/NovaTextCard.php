<?php

namespace Hcuro\NovaBreadcrumb;

use Laravel\Nova\Card;

class NovaTextCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, 2/3, full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the card.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-text-card';
    }

    /**
     * Set the HTML content.
     *
     * @param  string  $html
     * @return $this
     */
    public function html(string $html)
    {
        return $this->withMeta(['html' => $html, 'type' => 'html']);
    }

    /**
     * Set items to display as comma-separated list.
     *
     * @param  array  $items
     * @return $this
     */
    public function items(array $items)
    {
        return $this->withMeta(['items' => $items, 'type' => 'list']);
    }

    /**
     * Set the separator for list items.
     *
     * @param  string  $separator
     * @return $this
     */
    public function separator(string $separator = ', ')
    {
        return $this->withMeta(['separator' => $separator]);
    }

    /**
     * Remove the top spacing/gap to sit flush at the top.
     *
     * @return $this
     */
    public function withoutTopSpacing()
    {
        return $this->withMeta(['noTopSpacing' => true]);
    }

    /**
     * Set custom top spacing.
     *
     * @param  string  $spacing
     * @return $this
     */
    public function topSpacing(string $spacing)
    {
        return $this->withMeta(['topSpacing' => $spacing]);
    }

    /**
     * Set text alignment.
     *
     * @param  string  $align left|center|right
     * @return $this
     */
    public function align(string $align)
    {
        return $this->withMeta(['align' => $align]);
    }

    /**
     * Set custom CSS classes.
     *
     * @param  string  $classes
     * @return $this
     */
    public function classes(string $classes)
    {
        return $this->withMeta(['classes' => $classes]);
    }
}
