<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/10/2018
 * Time: 15:57
 */

namespace AppBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
final class DeserializeEntity
{
    /**
     * @var string
     * @Required()
     */
    public $type;

    /**
     * @var string
     * @Required()
     */
    public $idField;

    /**
     * @var string
     * @Required()
     */
    public $setter;

    /**
     * @var string
     * @Required()
     */
    public $idGetter;

}