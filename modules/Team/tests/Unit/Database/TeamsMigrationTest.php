<?php

namespace Team\Unit\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Team\Models\Team;
use Tests\TestCase;

/**
 * @package Team\Unit\Database
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class TeamsMigrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->tableName = 'teams';
        $this->db = DB::getSchemaBuilder();
        $this->schema = Schema::getConnection()->getDoctrineSchemaManager();
        $this->columns = $this->schema->listTableColumns($this->tableName);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function table_should_be_named_accordingly()
    {
        $this->assertEquals($this->tableName, with(new Team)->getTable());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_an_id_column()
    {
        $this->assertArrayHasKey('id', $this->columns);
        $this->assertTrue($this->columns['id']->getAutoincrement());
        $this->assertEquals('integer', $this->db->getColumnType($this->tableName, 'id'));
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_a_name_column()
    {
        $this->assertArrayHasKey('name', $this->columns);
        $this->assertTrue($this->columns['name']->getNotNull());
        $this->assertEquals('string', $this->db->getColumnType($this->tableName, 'name'));
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_a_code_column()
    {
        $this->assertArrayHasKey('code', $this->columns);
        $this->assertTrue($this->columns['code']->getNotNull());
        $this->assertEquals('string', $this->db->getColumnType($this->tableName, 'code'));
        $this->assertArrayHasKey(
            sprintf('%s_code_unique', $this->tableName),
            $this->schema->listTableIndexes($this->tableName)
        );
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_a_description_column()
    {
        $this->assertArrayHasKey('description', $this->columns);
        $this->assertFalse($this->columns['description']->getNotNull());
        $this->assertEquals('text', $this->db->getColumnType($this->tableName, 'description'));
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_an_icon_column()
    {
        $this->assertArrayHasKey('icon', $this->columns);
        $this->assertFalse($this->columns['icon']->getNotNull());
        $this->assertEquals('string', $this->db->getColumnType($this->tableName, 'icon'));
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_a_user_id_column()
    {
        $this->assertArrayHasKey('user_id', $this->columns);
        $this->assertTrue($this->columns['user_id']->getNotNull());
        $this->assertFalse($this->columns['user_id']->getUnsigned());
        $this->assertEquals('integer', $this->db->getColumnType($this->tableName, 'user_id'));
        $this->assertArrayHasKey(
            sprintf('%s_user_id_index', $this->tableName),
            $this->schema->listTableIndexes($this->tableName)
        );
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_a_created_at_column()
    {
        $this->assertArrayHasKey('created_at', $this->columns);
        $this->assertFalse($this->columns['created_at']->getNotNull());
        $this->assertEquals('datetime', $this->db->getColumnType($this->tableName, 'created_at'));
    }

    /**
     * @test
     * @group  unit
     * @group  unit:migration
     * @return void
     */
    public function it_should_have_an_updated_at_column()
    {
        $this->assertArrayHasKey('updated_at', $this->columns);
        $this->assertFalse($this->columns['updated_at']->getNotNull());
        $this->assertEquals('datetime', $this->db->getColumnType($this->tableName, 'updated_at'));
    }
}
