<?php

/**
 * WireAction
 *
 * Base class for actions in ProcessWire
 *
 */
abstract class WireAction extends WireData implements Module {

	/**
	 * Return array of module information
	 *
	 * @return array
	 *
	 */
	public static function getModuleInfo() {
		return array(
			'title' => 'WireAction (abstract)', 
			'summary' => 'Base class for WireActions',
			'version' => 0
			);
	}

	/**
	 * Instance of the object that is running this action
	 *
	 */
	protected $runner = null;

	/**
	 * Define any default values for configuration
	 *
	 */
	public function __construct() {
		// $this->set('key', 'value'); 
	}

	/**
	 * Module initialization
	 *
	 */
	public function init() { }

	/**
	 * Return the string type (class name) of items that this action operates upon
	 *
	 * @return string
	 *
	 */
	public function getItemType() {
		return 'Wire';
	}

	/**
	 * Is the given item valid for use by this action?
	 *
	 * @param object $item
	 * @return bool True if valid, false if not
	 *
	 */
	public function isValidItem($item) {
		$type = $this->getItemType();
		return $item instanceof $type;
	}

	/**
	 * Execute the action for the given item
	 *
	 * @param Wire $item Item to operate upon
	 * @return bool True if the item was successfully operated upon, false if not. 
	 *
	 */
	public function ___execute($item) {
		return $this->isValidItem($item);
	}

	/**
	 * Return any Inputfields needed to configure this action
	 *
	 * @return InputfieldWrapper
	 *
	 */
	public function ___getConfigInputfields() {
		$info = $this->wire('modules')->getModuleInfo($this->className());
		$fieldset = $this->wire('modules')->get('InputfieldFieldset');
		$fieldset->label = $info['title'];
		$fieldset->description = $info['summary'];
		return $fieldset; 
	}

	/**
	 * Set the object instance that is running this action
	 *
	 * If an action knows that it only accepts a certain type of runner, then 
	 * it should throw a WireException if the given runner is not valid.
	 *
	 * @param Wire $runner
	 *
	 */
	public function setRunner(Wire $runner) {
		$this->runner = $runner; 
	}

	/**
	 * Get the object instance that is running this action
	 *
	 * Actions should not generally depend on a particular runner, but should take advantage
	 * of a specific runner if it benefits the action. 
	 *
	 * @return Wire|null Returns null if no runner has been set
	 *
	 */
	public function getRunner() {
		return $this->runner; 
	}

	public function isSingular() {
		return true; 
	}

	public function isAutoload() {
		return false;
	}
}
