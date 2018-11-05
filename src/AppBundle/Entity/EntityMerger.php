<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 23/10/2018
 * Time: 10:05
 */

namespace AppBundle\Entity;


use Doctrine\Common\Annotations\Reader;

class EntityMerger
{
    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * EntityMerger constructor.
     * @param Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param $entity
     * @param $changes
     */
    public function merge($entity, $changes): void
    {
        // Get $entity class name or false if it's not a class
        $entityClassName = get_class($entity);

        if (false === $entityClassName) {
            throw new \InvalidArgumentException('$entity is not a class');
        }

        // Get $change class name or false if it's not a class
        $changesClassName = get_class($changes);

        if (false === $changesClassName) {
            throw new \InvalidArgumentException('$changes is not a class');
        }


        // Continue only if $changes object is of the same class as $entity or $changes is a subclass of $entity
        if (!is_a($changes, $entityClassName)) {
            throw new \InvalidArgumentException("Connot merge object of class $changesClassName with object of class $entityClassName");
        }

        $entityReflection = new \ReflectionObject($entity);
        $changesReflection = new \ReflectionObject($changes);

        foreach ($changesReflection->getProperties() as $changedProperty) {
            $changedProperty->setAccessible(true);
            $changedPropertyValue = $changedProperty->getValue($changes);

            // Ignore $changes property with null value
            if (null === $changedPropertyValue){
                continue;
            }

            // Ignore $changes property if it's not present on $entity
            if (!$entityReflection->hasProperty($changedProperty->getName())){
                continue;
            }

            $entityProperty = $entityReflection->getProperty($changedProperty->getName());
            $annotation = $this->annotationReader->getPropertyAnnotation($entityProperty, Id::class);

            // Ignore $changes property that has Doctrine @Id annotation
            if (null !== $annotation) {
                continue;
            }

            $entityProperty->setAccessible(true);
            $entityProperty->setValue($entity, $changedPropertyValue);
        }
    }

}