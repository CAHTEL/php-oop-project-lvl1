
Data validator is a library with which you can check the correctness of any data. The project is based on the yup library.

### Hexlet tests and linter status:
[![Actions Status](https://github.com/CAHTEL/php-oop-project-lvl1/workflows/hexlet-check/badge.svg)](https://github.com/CAHTEL/php-oop-project-lvl1/actions)
[![Actions Status](https://github.com/CAHTEL/php-oop-project-lvl1/actions/workflows/main.yml/badge.svg)](https://github.com/CAHTEL/php-oop-project-lvl1/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/8e2690d5b978c851d0d0/maintainability)](https://codeclimate.com/github/CAHTEL/php-oop-project-lvl1/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/8e2690d5b978c851d0d0/test_coverage)](https://codeclimate.com/github/CAHTEL/php-oop-project-lvl1/test_coverage)

# install

```
$ git clone https://github.com/CAHTEL/php-oop-project-lvl1.git

$ make install
```


# Usage
```
$validator = new Validator();
$schema = $v->string();
$schema->required();
$schema->isValid('test string')
```
