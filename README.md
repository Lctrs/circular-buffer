# Circular Buffer

[![Integrate](https://github.com/Lctrs/circular-buffer/workflows/Integrate/badge.svg)](https://github.com/Lctrs/circular-buffer/actions)
[![Release](https://github.com/Lctrs/circular-buffer/workflows/Release/badge.svg)](https://github.com/Lctrs/circular-buffer/actions)
[![Renew](https://github.com/Lctrs/circular-buffer/workflows/Renew/badge.svg)](https://github.com/Lctrs/circular-buffer/actions)

[![Mutation Score](https://img.shields.io/endpoint?url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FLctrs%2Fcircular-buffer%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/Lctrs/circular-buffer/master)
[![Code Coverage](https://codecov.io/gh/Lctrs/circular-buffer/branch/master/graph/badge.svg)](https://codecov.io/gh/Lctrs/circular-buffer)
[![Type Coverage](https://shepherd.dev/github/Lctrs/circular-buffer/coverage.svg)](https://shepherd.dev/github/Lctrs/circular-buffer)

[![Latest Stable Version](https://img.shields.io/packagist/v/Lctrs/circular-buffer?style=flat-square)](https://packagist.org/packages/Lctrs/circular-buffer)
[![Total Downloads](https://img.shields.io/packagist/dt/Lctrs/circular-buffer?style=flat-square)](https://packagist.org/packages/Lctrs/circular-buffer)

## Installation

:bulb: This is a great place for showing how to install the package, see below:

Run

```sh
$ composer require lctrs/circular-buffer
```

## Usage

Creating an empty circular buffer of size eg. 2:
```php
use Lctrs\CircularBuffer\CircularBuffer;

$buffer = CircularBuffer::ofCapacity(2);
$buffer->write('foo');
$buffer->read(); // foo
```

You can also create a prefilled buffer:
```php
use Lctrs\CircularBuffer\CircularBuffer;

$buffer = CircularBuffer::prefilled(2, ['foo', 'bar']);
```



## Changelog

Please have a look at [`CHANGELOG.md`](CHANGELOG.md).

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).

## License

This package is licensed using the MIT License.

Please have a look at [`LICENSE.md`](LICENSE.md).
