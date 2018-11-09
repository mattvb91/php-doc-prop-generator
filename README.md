# php-doc-prop-generator
DocBlock @property generation for PHP class documentation from your DB structure.

This package will generate classes based on your DB structure that you can then use to @mixin for your real classes:

```php
<?php

namespace DocProps;

/**
 * AUTO GENERATED! ONLY USE FOR @mixin documentation
 * @property int id
 * @property string username
 */
final class userProps {}
```

So now if you have a `User` class that you want typehints available in your IDE you 
can simply `@mixin \DocProps\userProps`.

### Installation

```
composer require --dev mattvb91/docpropgenerator
```

### Usage
```
 ./vendor/bin/docPropGenerator.php                                                                                                         


--dbHost <argument>
     Required.


--dbName <argument>
     Required.


--dbPass <argument>
     Required.


--dbUser <argument>
     Required.


--help
     Show the help page for this command.

```

### Licence

```
MIT License

Copyright (c) 2018 Matthias von Bargen

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

```
