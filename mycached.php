<?php
/*
       store_value('my_unique_key', $var);
       $var = get_value('my_unique_key');

       To clear all the shared memory when testing, or what not you can use
   the unix
       command ipcs, and ipcrm.  Here is what I use which removes the shared
   memory
       segments, and also semaphores
       ipcs | cut -d" " -f2 | xargs -n1 ipcrm -s
       ipcs | cut -d" " -f2 | xargs -n1 ipcrm -m

*/

DEFINE('NDS', 60 * 60);

function store_value($key,$var)
{
    $sem_key = ftok(__FILE__,'R');
    $sem_id = sem_get($sem_key,1024,0644 | IPC_CREAT);
    sem_acquire($sem_id);
    $shm_key = ftok(__FILE__, 'a');
    $id = shmop_open($shm_key, "n", 644, 100);
    echo "store id" . $id . ",<br>";
    echo "sem_key=" . $sem_key . "shm_key=" . $shm_key . "<br>";
    if (!$id) return false;
    shmop_write($id,strlen($var),9);
    shmop_write($id,$var,strlen($var));
    shmop_close($id);
    sem_release($sem_id);
    return true;
}

function get_value($key)
{
    $sem_key = ftok(__FILE__,'R');
    $sem_id = sem_get($sem_key,1024,0644 | IPC_CREAT);
    sem_acquire($sem_id);
    $shm_key = ftok(__FILE__, 'a');
    $id =& shmop_open($shm_key, "a", 0644, 100);
    echo "read id" . $id . ",<br>";
    echo "sem_key=" . $sem_key . "shm_key=" . $shm_key . "<br>";
    if (!$id) return 0;
    $len = shmop_read($id,0,9);
    $var = shmop_read($id,9,$len);
    shmop_close($id);
    sem_release($sem_id);
    return $var;
}

?>
