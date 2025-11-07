# Nova Cards Collection

A collection of flexible Laravel Nova card components including breadcrumb navigation and text/HTML display cards.

## Components

### Nova Breadcrumb Card
Displays customizable breadcrumb navigation at the top of your resources.

### Nova Text Card
Displays HTML content or comma-separated lists at the top of your resources.

## Features

**Breadcrumb Card:**
- Customizable breadcrumb items with labels and optional URLs
- Flexible hierarchical structure support
- Optional home icon for the first breadcrumb item
- Customizable separator character

**Text Card:**
- Display rich HTML content
- Display arrays as comma-separated lists
- Customizable separators for lists
- Text alignment control
- Custom CSS classes support

**Both Cards:**
- Dark mode support
- Responsive design
- Spacing control methods
- Compatible with Laravel Nova 4 & 5

## Installation

Install the package via Composer:

```bash
composer require hcuro/nova-breadcrumb
```

### Publish Assets (Windows or if symlinks don't work)

If you encounter issues with missing assets, publish them to your public directory:

```bash
php artisan vendor:publish --tag=nova-breadcrumb-assets --force
```

This will copy the compiled assets to `public/vendor/nova-breadcrumb/`.

## Building Assets

If you're developing or modifying this package, you'll need to build the JavaScript and CSS assets:

```bash
npm install
npm run dev    # For development
npm run prod   # For production
```

## Usage

### Basic Usage

Add the breadcrumb card to your Nova resource's `cards()` method:

```php
use Hcuro\NovaBreadcrumb\NovaBreadcrumb;

public function cards(NovaRequest $request)
{
    return [
        (new NovaBreadcrumb)->items([
            ['label' => 'Dashboard', 'url' => '/'],
            ['label' => 'Users', 'url' => '/resources/users'],
            ['label' => 'User Details', 'url' => null],
        ]),
    ];
}
```

### Advanced Usage

#### Using the Fluent API

You can also build breadcrumbs using the fluent API:

```php
(new NovaBreadcrumb)
    ->addItem('Dashboard', '/')
    ->addItem('Organizations', '/resources/organizations')
    ->addItem('Projects', '/resources/projects')
    ->addItem('Current Project')
    ->separator('>')
    ->showHomeIcon();
```

#### Custom Separator

Change the breadcrumb separator:

```php
(new NovaBreadcrumb)
    ->items([
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Products', 'url' => '/resources/products'],
        ['label' => 'Product Details'],
    ])
    ->separator('>'); // Default is '/'
```

#### Home Icon

Display a home icon for the first breadcrumb item:

```php
(new NovaBreadcrumb)
    ->items([
        ['label' => 'Dashboard', 'url' => '/'],
        ['label' => 'Settings', 'url' => null],
    ])
    ->showHomeIcon(); // Replaces first label with a home icon
```

#### Spacing Control

Control the top spacing to remove Nova's default grid gap:

```php
// Remove top spacing completely (sits flush at top)
(new NovaBreadcrumb)
    ->items([...])
    ->withoutTopSpacing();

// Set custom top spacing
(new NovaBreadcrumb)
    ->items([...])
    ->topSpacing('-1rem'); // Can use any CSS value
```

By default, the breadcrumb respects Nova's grid spacing. Use `withoutTopSpacing()` to make it sit flush at the top of the page, or `topSpacing()` to set a custom margin-top value.

**Responsive Behavior:** When using `withoutTopSpacing()`, the component automatically applies less aggressive negative margin on mobile devices (-0.75rem) to prevent overlap issues, and the full negative margin (-1.5rem) on desktop screens (≥768px).

### Real-World Examples

#### E-commerce Product Hierarchy

```php
public function cards(NovaRequest $request)
{
    $product = $request->findResourceOrFail();

    return [
        (new NovaBreadcrumb)->items([
            ['label' => 'Dashboard', 'url' => '/'],
            ['label' => 'Catalog', 'url' => '/resources/categories'],
            ['label' => $product->category->name, 'url' => "/resources/categories/{$product->category_id}"],
            ['label' => $product->name, 'url' => null],
        ])->showHomeIcon(),
    ];
}
```

#### Multi-tenant Organization Structure

```php
public function cards(NovaRequest $request)
{
    $project = $request->findResourceOrFail();

    return [
        (new NovaBreadcrumb)
            ->addItem('Home', '/')
            ->addItem($project->organization->name, "/resources/organizations/{$project->organization_id}")
            ->addItem('Projects', "/resources/organizations/{$project->organization_id}/projects")
            ->addItem($project->name)
            ->separator('»'),
    ];
}
```

#### Document Management System

```php
public function cards(NovaRequest $request)
{
    $document = $request->findResourceOrFail();
    $breadcrumbs = [['label' => 'Documents', 'url' => '/resources/documents']];

    // Build folder hierarchy
    foreach ($document->folders as $folder) {
        $breadcrumbs[] = [
            'label' => $folder->name,
            'url' => "/resources/folders/{$folder->id}"
        ];
    }

    // Add current document
    $breadcrumbs[] = ['label' => $document->title, 'url' => null];

    return [
        (new NovaBreadcrumb)->items($breadcrumbs),
    ];
}
```

---

## Nova Text Card

The `NovaTextCard` component allows you to display HTML content or comma-separated lists at the top of your resources.

### Basic Usage

#### Display HTML Content

```php
use Hcuro\NovaBreadcrumb\NovaTextCard;

public function cards(NovaRequest $request)
{
    return [
        (new NovaTextCard)->html('<strong>Important:</strong> This record is archived and cannot be edited.'),
    ];
}
```

#### Display Array as List

```php
public function cards(NovaRequest $request)
{
    return [
        (new NovaTextCard)->items(['Active', 'Verified', 'Premium Member']),
    ];
}
```

### Advanced Usage

#### Custom Separator

Change the list separator (default is `, `):

```php
(new NovaTextCard)
    ->items(['Tag 1', 'Tag 2', 'Tag 3'])
    ->separator(' • ');
```

#### Text Alignment

Control text alignment:

```php
(new NovaTextCard)
    ->html('<p>Centered content</p>')
    ->align('center'); // left, center, right
```

#### Remove Top Spacing

Make the card sit flush at the top:

```php
(new NovaTextCard)
    ->html('<p>This sits at the very top</p>')
    ->withoutTopSpacing();
```

#### Custom CSS Classes

Add custom CSS classes for additional styling:

```php
(new NovaTextCard)
    ->html('<p class="my-custom-class">Custom styled content</p>')
    ->classes('custom-wrapper-class');
```

### Real-World Examples

#### Status Banner

```php
public function cards(NovaRequest $request)
{
    $user = $request->findResourceOrFail();

    $badges = [];
    if ($user->is_verified) $badges[] = 'Verified';
    if ($user->is_premium) $badges[] = 'Premium';
    if ($user->is_admin) $badges[] = 'Administrator';

    return [
        (new NovaTextCard)
            ->items($badges)
            ->separator(' | ')
            ->withoutTopSpacing(),
    ];
}
```

#### Alert Message

```php
public function cards(NovaRequest $request)
{
    return [
        (new NovaTextCard)
            ->html('
                <div style="padding: 0.5rem; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 0.25rem;">
                    <strong>Warning:</strong> This resource is scheduled for deletion in 30 days.
                </div>
            ')
            ->withoutTopSpacing(),
    ];
}
```

#### Metadata Display

```php
public function cards(NovaRequest $request)
{
    $resource = $request->findResourceOrFail();

    return [
        (new NovaTextCard)->html("
            <p><strong>Created:</strong> {$resource->created_at->format('M d, Y')}</p>
            <p><strong>Last Updated:</strong> {$resource->updated_at->diffForHumans()}</p>
            <p><strong>Author:</strong> {$resource->author->name}</p>
        ")->withoutTopSpacing(),
    ];
}
```

#### Tags Display

```php
public function cards(NovaRequest $request)
{
    $post = $request->findResourceOrFail();

    return [
        (new NovaTextCard)
            ->items($post->tags->pluck('name')->toArray())
            ->separator(', '),
    ];
}
```

---

## Breadcrumb Item Structure

Each breadcrumb item should be an array with the following keys:

- `label` (required): The text to display for the breadcrumb
- `url` (optional): The URL to link to. If `null` or omitted, the item will not be clickable

```php
[
    'label' => 'Page Name',
    'url' => '/path/to/page',  // Optional
]
```

## Customization

### Styling

The card uses Nova's CSS variables for consistent theming. You can customize the appearance by overriding these variables in your application:

- `--primary`: Link color
- `--primary-dark`: Link hover color
- `--60`, `--80`, `--40`: Text colors
- `--white`: Background color (light mode)
- `--gray-800`: Background color (dark mode)

### Width

By default, the card takes full width. You can customize this in the card class if needed by modifying the `$width` property.

## Requirements

- PHP 8.1 or higher
- Laravel Nova 4.0 or 5.0
- Vue 3

## License

This package is open-sourced software licensed under the MIT license.

## Support

For issues, feature requests, or questions, please open an issue on the GitHub repository.
