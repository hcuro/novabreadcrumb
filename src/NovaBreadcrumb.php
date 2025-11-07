<?php

namespace Hcuro\NovaBreadcrumb;

use Laravel\Nova\Card;

class NovaBreadcrumb extends Card
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
        return 'nova-breadcrumb';
    }

    /**
     * Set the breadcrumb items.
     *
     * @param  array  $items
     * @return $this
     */
    public function items(array $items)
    {
        return $this->withMeta(['items' => $items]);
    }

    /**
     * Set a single breadcrumb item.
     *
     * @param  string  $label
     * @param  string|null  $url
     * @return $this
     */
    public function addItem(string $label, ?string $url = null)
    {
        $items = $this->meta['items'] ?? [];
        $items[] = [
            'label' => $label,
            'url' => $url,
        ];

        return $this->withMeta(['items' => $items]);
    }

    /**
     * Set the breadcrumb separator.
     *
     * @param  string  $separator
     * @return $this
     */
    public function separator(string $separator = '/')
    {
        return $this->withMeta(['separator' => $separator]);
    }

    /**
     * Show home icon for the first item.
     *
     * @param  bool  $show
     * @return $this
     */
    public function showHomeIcon(bool $show = true)
    {
        return $this->withMeta(['showHomeIcon' => $show]);
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
}
