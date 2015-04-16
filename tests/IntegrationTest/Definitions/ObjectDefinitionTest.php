<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\Test\IntegrationTest\Definitions;

use DI\ContainerBuilder;

/**
 * Test object definitions
 *
 * TODO add more tests
 *
 * @coversNothing
 */
class ObjectDefinitionTest extends \PHPUnit_Framework_TestCase
{
    public function test_object_without_autowiring()
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(false);
        $builder->useAnnotations(false);
        $builder->addDefinitions(array(
            // with the same name
            'stdClass' => \DI\object('stdClass'),
            // with a different name
            'object' => \DI\object('DateTime')
                ->constructor('now', null),
        ));
        $container = $builder->build();

        $this->assertInstanceOf('stdClass', $container->get('stdClass'));
        $this->assertInstanceOf('DateTime', $container->get('object'));
    }
}