# WideFocus Feed Source

This package contains models to use a feed source.

## Identity source

An identity source provides identities. This would most likely be a list of
primary keys from a database.

```php
<?php
use WideFocus\Feed\Source\IdentitySourceInterface;

/** @var IdentitySourceInterface $idSource */
$idSource  = new CustomIdSource();
$entityIds = $idSource->getEntityIds();
```

## Value source

A value source provides the values for identities. The values are fetched for a
single attribute.

```php
<?php
use WideFocus\Feed\Source\ValueSourceInterface;

/** @var ValueSourceInterface $valueSource */
$valueSource = new CustomValueSource();
$names       = $valueSource->getEntityValues($entityIds, 'name');
```

## Source conditions

Identities can be filtered by conditions. A condition decides based on the
identity whether an item should be used in a feed. It collects the item data
by itself, for example using a value source.

```php
<?php
use WideFocus\Feed\Source\Condition\SourceConditionInterface;

/** @var SourceConditionInterface $condition */
$condition = new CustomCondition();
$condition->prepare($entityIds);
foreach ($entityIds as $entityId) {
    if ($condition->isValid($entityId)) {
        // The entity is validated.
    }
}
```

Use `SourceConditionCombinationInterface` to create a combination of conditions.

## Source fields

A source field provides a feed item with data. It always gets the data of just
one attribute. It is able to get the data by itself, for example using a value
source.

```php
<?php
use WideFocus\Feed\Source\Field\SourceFieldInterface;

/** @var SourceFieldInterface $field */
$field = new CustomField();
$field->prepare($entityIds);

foreach ($entityIds as $entityId) {
    $item = new ArrayObject();
    $item->offsetSet(
        'name',
        $field->getValue($entityId)
    );
    // The name has been set on the item.
}
```

Use `SourceFieldCombinationInterface` to create a combination of fields.

## Source iterators

This package provides a number of iterators that apply conditions and fields
on a source.

### Identity source iterator

The identity source iterator iterates over the values of an identity source.

```php
<?php
use WideFocus\Feed\Source\Iterator\IdentitySourceIterator;

$identityIterator = new IdentitySourceIterator($idSource);
foreach ($identityIterator as $identity) {
    // An identity.
}
```

### Validated identity iterator

The validated identity iterator validates identities according to conditions
while iterating over them. It only returns the identities which comply to the
conditions.

```php
<?php
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Iterator\ValidatedIdentityIterator;

/** @var SourceConditionCombinationInterface $conditions */
$conditions = new CustomConditionCombination();

$validatedIterator = new ValidatedIdentityIterator(
    $identityIterator,
    $conditions,
    500
);

foreach ($validatedIterator as $identity) {
    // A validated identity.
}
```

### Identity to item iterator
 
The identity to item iterator iterates converts identities to items with values
while iterating over them. The returned items are instances of ArrayAccess.

```php
<?php
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Iterator\IdentityToItemIterator;

/** @var SourceFieldCombinationInterface $fields */
$fields = new CustomFieldCombination();

$idToItemIterator = new IdentityToItemIterator(
    $identityIterator,
    $fields,
    500
);

foreach ($idToItemIterator as $item) {
    // An item with values.
}
```

### Combined iterator

A combined iterator can be created with the source iterator factory. It returns
an iterator that gets values from an identity source, validates them and
converts them to items with values.

```php
<?php
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactory;

/** @var IdentitySourceInterface $idSource */
$idSource = new CustomSource();

/** @var SourceConditionCombinationInterface $conditions */
$conditions = new CustomConditionCombination();

/** @var SourceFieldCombinationInterface $fields */
$fields = new CustomFieldCombination();

$factory  = new SourceIteratorFactory(500);
$iterator = $factory->createIterator(
    $idSource,
    $conditions,
    $fields
);

foreach ($iterator as $item) {
    // A validated item with values.
}
```
