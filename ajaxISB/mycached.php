<?php
define('__key',1647675);

function store_value($key,$var)
{
    $semid = sem_get(__key+1, 1, 0644 );
    if ($sem = sem_acquire($semid))
    {
    	$shmid = shm_attach(__key);
    	if ($shmid>0)
    	{
    	    shm_put_var($shmid,$key,$var);
    	    @shm_detach($shmid);
    	}
    }
    @sem_release($sem);
    @sem_remove($semid);
    return true;
}

function get_value($key)
{
    $semid = sem_get(__key+1, 1, 0644 );
    if ($sem = sem_acquire($semid))
    {
    	$shmid = shm_attach(__key);
    	if ($shmid>0)
    	{
    	    $ret = shm_get_var($shmid,$key);
    	    @shm_detach($shmid);
    	}
    }
    @sem_release($sem);
    @sem_remove($semid);
    return $ret;
}

?>
