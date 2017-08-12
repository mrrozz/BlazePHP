namespace BlazePHP;

class Session
{
	// private config;
	private type;
	private id;

	public function __construct(<SessionConfig> config)
	{
		// let this->config = config;
		if(empty(config->id)) {
			let this->id = UniqueId::make("blazephp_session_");
		}
		else {
			let this->id = config->id;
		}
	}


	// public bool close ( void )
	public function close()
	{

	}


	// public bool destroy ( string $session_id )
	public function destroy(string id)
	{

	}


	// public bool gc ( int $maxlifetime )
	public function gc(int maxLifeTime)
	{

	}


	// public bool open ( string $save_path , string $session_name )
	public function open(string savePath, string name)
	{

	}


	// public string read ( string $session_id )
	public function read(string id)
	{

	}


	// public bool write ( string $session_id , string $session_data )
	public function write(string id, string data)
	{

	}
}
