# Nova Breadcrumb Card

A flexible Laravel Nova card component for displaying customizable breadcrumb navigation at the top of your resources.

## Features

- Customizable breadcrumb items with labels and optional URLs
- Flexible hierarchical structure support
- Optional home icon for the first breadcrumb item
- Customizable separator character
- Dark mode support
- Responsive design
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
