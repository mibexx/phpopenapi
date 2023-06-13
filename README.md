# PHPOpenApi

PHPOpenApi is a PHP library that allows you to process and work with OpenAPI specifications.

## Installation

You can install PHPOpenApi via Composer. Run the following command in your terminal:

```bash
composer require mibexx/phpopenapi
```

## Usage

### Processing an OpenAPI Specification

To process an OpenAPI specification and retrieve the corresponding DTO, you can use the OpenAPIFacade provided by PHPOpenApi. Here's an example of how to use it:

```php
use Mibexx\PHPOpenApi\Application\OpenAPIFacade;

// Create the facade instance
$openAPIFacade = new OpenAPIFacade();

// Define the configuration object
$source = 'example/openapi.yaml';

// Process the OpenAPI specification
$openapiDto = $openAPIFacade->processOpenAPI($source);

// Access the properties of the OpenAPIDto
echo $openapiDto->openapi;
echo $openapiDto->info->title;
echo $openapiDto->servers[0]['url'];
// Access other properties as needed
```

In the above example, we first create an instance of the OpenAPIFacade. Then, we define the source path of the OpenAPI specification. Finally, we call the processOpenAPI method on the facade, passing the source, which returns the OpenAPIDto object. We can then access the properties of the OpenAPIDto as needed.

## License

PHPOpenApi is open-source software licensed under the MIT license.