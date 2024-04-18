<?php

/**
 * Class ApiTestCase
 */
class ApiTestCase extends TestCase
{

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    function __construct()
    {
        parent::__construct();

        $this->faker = \Faker\Factory::create();
    }

    /**
     * Sets up the migrations and fixtures
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->app['artisan']->call('iceangel:setup');
    }

    /**
     * Creates an Account and returns an instance of the Model.
     *
     * @param bool $activated
     * @param array $data
     *
     * @return Account
     */
    public function createAccount($activated = false, array $data = array())
    {
        $default = [

            'email' => $this->faker->email,

            'password' => 'password',

            'birth_date' => ['year' => $this->faker->year, 'month' => $this->faker->month, 'day' => $this->faker->dayOfMonth,],

            'nationality' => $this->faker->randomDigitNotNull,

            'first_name' => $this->faker->firstName,

            'last_name' => $this->faker->lastName,

            'phone' => ['code' => $this->faker->randomDigitNotNull, 'number' => $this->faker->phoneNumber,],

            'emergency_channels' => [],

            'questions' => [],

            'photo' => $this->faker->imageUrl(100, 100),

        ];

        if ($activated) $data['activated'] = true;

        $account = Sentry::createUser(array_merge($default, $data));

        // Find the Account group
        $accountGroup = Sentry::findGroupByName('Account');

        // Add to Account group
        $account->addGroup($accountGroup);

        return $account;
    }

    /**
     * Creates a Member and returns an instance of the Model.
     *
     * @param Account $account
     * @param array $data
     * @return Member
     */
    public function createMember(Account $account, array $data = array())
    {

        $default = [

            'email' => $this->faker->email,

            'password' => 'password',

            'birth_date' => ['year' => $this->faker->year, 'month' => $this->faker->month, 'day' => $this->faker->dayOfMonth,],

            'nationality' => $this->faker->randomDigitNotNull,

            'first_name' => $this->faker->firstName,

            'last_name' => $this->faker->lastName,

            'phone' => ['code' => $this->faker->randomDigitNotNull, 'number' => $this->faker->phoneNumber,],

            'emergency_channels' => [],

            'questions' => [],

            'additional_information' => [],

            'photo' => $this->faker->imageUrl(100, 100),

        ];


        $member = $account->members()->create(array_merge($default, $data));

        // Find the Member group
        $memberGroup = Sentry::findGroupByName('Member');

        // Add to Member group
        $member->addGroup($memberGroup);

        return $member;
    }

    /**
     * Resets the migrations.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->app['artisan']->call('migrate:reset');
    }

} 