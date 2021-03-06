<?php
/**
 * BEdita, API-first content management framework
 * Copyright 2017 ChannelWeb Srl, Chialab Srl
 *
 * This file is part of BEdita: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * See LICENSE.LGPL or <http://gnu.org/licenses/lgpl-3.0.html> for more details.
 */

namespace BEdita\GraphQL\Test\TestCase\Model\Action;

use BEdita\GraphQL\Model\Action\QueryAction;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * {@see \BEdita\GraphQL\Model\Action\QueryAction} Test Case
 *
 * @coversDefaultClass \BEdita\GraphQL\Model\Action\QueryAction
 */
class QueryActionTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.BEdita/Core.object_types',
        'plugin.BEdita/Core.property_types',
        'plugin.BEdita/Core.properties',
        'plugin.BEdita/Core.relations',
        'plugin.BEdita/Core.relation_types',
        'plugin.BEdita/Core.objects',
        'plugin.BEdita/Core.locations',
        'plugin.BEdita/Core.media',
        'plugin.BEdita/Core.profiles',
        'plugin.BEdita/Core.roles',
        'plugin.BEdita/Core.users',
    ];

    /**
     * Test simple query execution.
     *
     * @return void
     *
     * @covers ::execute()
     * @covers ::buildSchema()
     * @covers \BEdita\GraphQL\Model\Type\ObjectsType::__construct()
     * @covers \BEdita\GraphQL\Model\Type\QueryType::__construct()
     * @covers \BEdita\GraphQL\Model\Type\ResourcesType::__construct()
     */
    public function testExecute()
    {
        $query = '{user(id: "1") { username }}';
        $action = new QueryAction();
        $result = $action(compact('query'));

        $expected = [
            'data' => [
                'user' => [
                    'username' => 'first user',
                ]
            ]
        ];

        static::assertArrayHasKey('data', $result);
        static::assertArrayNotHasKey('errors', $result);
        static::assertEquals($expected, $result);

        $query = '{role(id: "1") { name }}';
        $action = new QueryAction();
        $result = $action(compact('query'));

        $expected = [
            'data' => [
                'role' => [
                    'name' => 'first role',
                ]
            ]
        ];

        static::assertArrayHasKey('data', $result);
        static::assertArrayNotHasKey('errors', $result);
        static::assertEquals($expected, $result);
    }
}
