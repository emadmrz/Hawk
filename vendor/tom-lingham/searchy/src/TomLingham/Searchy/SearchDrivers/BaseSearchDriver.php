<?php namespace TomLingham\Searchy\SearchDrivers;

use TomLingham\Searchy\Interfaces\SearchDriverInterface;


abstract class BaseSearchDriver implements SearchDriverInterface {

	protected $table;
	protected $columns;
	protected $searchFields;
	protected $searchString;
	protected $relevanceFieldName;
	protected $query;

	/**
	 * @param null $table
	 * @param array $searchFields
	 * @param $relevanceFieldName
	 * @param array $columns
	 * @internal param $relevanceField
	 */
	public function __construct( $table = null, $searchFields = [], $relevanceFieldName, $columns = ['*'] )
	{
		$this->searchFields = $searchFields;
		$this->table = $table;
		$this->columns = $columns;
		$this->relevanceFieldName = $relevanceFieldName;
	}

	/**
	 * Specify which columns to return
	 *
	 * @return $this
	 */
	public function select()
	{
		$this->columns = func_get_args();
		return $this;
	}

	/**
	 * Specify the string that is is being searched for
	 *
	 * @param $searchString
	 * @return \Illuminate\Database\Query\Builder|mixed|static
	 */
	public function query( $searchString )
	{
		$this->searchString = trim(\DB::connection()->getPdo()->quote( $searchString ), "'");
		return $this;
	}

	/**
	 * Get the results of the search as an Array
	 *
	 * @return array
	 */
	public function get()
	{
		return $this->run()->get();
	}

	/**
	 * Returns an instance of the Laravel Fluent Database Query Object with the search
	 * queries applied
	 *
	 * @return array
	 */
	public function getQuery()
	{
		return $this->run();
	}

	/**
	 * Runs the 'having' method directly on the Laravel Fluent Database Query Object
	 * and returns the instance of the object
	 *
	 * @return mixed
	 */
	public function having()
	{
		return call_user_func_array([$this->run(), 'having'], func_get_args());
	}

	/**
	 * @return $this
	 */
	protected function run()
	{
		$this->query = \DB::table( $this->table )
			->select( $this->columns )
			->addSelect( $this->buildSelectQuery( $this->searchFields ) )
			->orderBy( $this->relevanceFieldName, 'desc' )
			->having( $this->relevanceFieldName, '>', 0 );

		return $this->query;
	}

	/**
	 * @param array $searchFields
	 * @return array|\Illuminate\Database\Query\Expression
	 */
	protected function buildSelectQuery( array $searchFields )
	{
		$query = [];

		foreach ($searchFields as $searchField) {
			if (strpos($searchField, '::')){
				$concatString = str_replace('::', ", ' ', ", $searchField);
				$query[] = $this->buildSelectCriteria( "CONCAT({$concatString})");
			} else {
				$query[] = $this->buildSelectCriteria( $searchField );
			}
		}

		return \DB::raw(implode(' + ', $query) . ' AS ' . $this->relevanceFieldName);
	}

	/**
	 * @param null $searchField
	 * @return string
	 */
	protected function buildSelectCriteria( $searchField = null )
	{
		$criteria = [];

		foreach( $this->matchers as $matcher => $multiplier){
			$criteria[] = $this->makeMatcher( $searchField, $matcher, $multiplier );
		}

		return implode(' + ', $criteria);
	}


	/**
	 * @param $searchField
	 * @param $matcherClass
	 * @param $multiplier
	 * @return mixed
	 */
	protected function makeMatcher( $searchField, $matcherClass, $multiplier )
	{
		$matcher = new $matcherClass( $multiplier );

		return $matcher->buildQueryString( $searchField, $this->searchString );
	}
}