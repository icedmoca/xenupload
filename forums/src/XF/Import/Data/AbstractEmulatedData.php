<?php

namespace XF\Import\Data;

abstract class AbstractEmulatedData extends AbstractData
{
	/**
	 * @var EntityEmulator
	 */
	protected $ee;

	abstract protected function getEntityShortName();

	protected function init()
	{
		$em = $this->em();
		$structure = $em->getEntityStructure($this->getEntityShortName());

		$this->ee = new EntityEmulator($this, $structure, $em->getValueFormatter());
	}

	public function set($field, $value, array $options = [])
	{
		return $this->ee->set($field, $value, $options);
	}

	public function get($field)
	{
		return $this->ee->get($field);
	}

	protected function write($oldId)
	{
		return $this->ee->insert($oldId, $this->db());
	}

	public function getEntityEmulator()
	{
		return $this->ee;
	}

	protected function importedIdFound($oldId, $newId)
	{
		$this->ee->setPrimaryKey($newId);
	}

	protected function logIp($ip, $date, array $options = [])
	{
		return $this->ee->logIp($this->db(), $ip, $date, $options);
	}

	protected function insertStateRecord($state, $contentDate, array $options = [])
	{
		if (empty($options['delete']) && method_exists($this, 'getDeletionLogData'))
		{
			$options['delete'] = $this->getDeletionLogData();
		}

		$this->ee->insertStateRecord($this->db(), $state, $contentDate, $options);
	}
}