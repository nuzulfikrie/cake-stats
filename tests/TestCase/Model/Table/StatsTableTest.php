<?php
namespace Stats\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Stats\Model\Table\StatsTable;

/**
 * Stats\Model\Table\StatsTable Test Case
 */
class StatsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Stats\Model\Table\StatsTable
     */
    public $Stats;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.stats.stats',
        'plugin.stats.stat_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Stats') ? [] : ['className' => 'Stats\Model\Table\StatsTable'];
        $this->Stats = TableRegistry::get('Stats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stats);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->assertInstanceOf('\Cake\ORM\Association\BelongsTo', $this->Stats->StatTypes);
        $this->assertTrue($this->Stats->hasBehavior('Timestamp'));
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $stat = [
            'stat_type_id' => 9999,
            'foreign_key' => 23
        ];

        $stat = $this->Stats->newEntity($stat);

        $this->Stats->save($stat);
        $this->assertFalse(empty($stat->errors()));
    }

    public function testIncrease()
    {
        $result = $this->Stats->increase('Test', 23);
    }
}