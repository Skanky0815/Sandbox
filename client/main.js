import Sandbox from './modules/Sandbox.js'
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8888/api.php'

Sandbox.run(axios);
