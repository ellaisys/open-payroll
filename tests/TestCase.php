<?php

namespace CleaniqueCoders\OpenPayroll\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        // $this->loadLaravelMigrations(['--database' => 'testbench']);

        // $this->artisan('migrate', ['--database' => 'testbench']);
    }

    /**
     * Load Package Service Provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array List of Service Provider
     */
    protected function getPackageProviders($app)
    {
        return [
            \CleaniqueCoders\OpenPayroll\OpenPayrollServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Assert the current database has table.
     * @param  string $table Table name.
     * @return void
     */
    protected function assertHasTable($table)
    {
        $this->assertTrue(Schema::hasTable($table));
    }

    /**
     * Assert the table has columns defined.
     * @param  string $table Table name.
     * @param  array $columns List of columns.
     * @return void
     */
    protected function assertTableHasColumns($table, $columns)
    {
        collect($columns)->each(function ($column) use ($table) {
            $this->assertTrue(Schema::hasColumn($table, $column));
        });
    }
}
