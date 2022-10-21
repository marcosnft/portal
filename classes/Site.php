<?php

class Site
{

    public static function updateUsuarioOnline()
    {
        if (isset($_SESSION['online'])) {
            $token = $_SESSION['online'];
            $horarioAtual = date('Y-m-d H:i:s');
            $check = MySql::conectar()->prepare("SELECT `id` from `projeto_01`.`tb_admin.online` WHERE token =?");
            $check->execute(array($_SESSION['online']));
            if ($check->rowCount() == 1) {
                $sql = MySql::conectar()->prepare("UPDATE `projeto_01`.`tb_admin.online` set ultima_acao = ? WHERE token = ?"); //Atualiza a hora de acorod com a sessão
                $sql->execute(array($horarioAtual, $token));
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H:i:s');
                $sql = MySql::conectar()->prepare("INSERT INTO `projeto_01`.`tb_admin.online` VALUES (null,?,?,?)");
                $sql->execute(array($ip, $horarioAtual, $token));
            }
        } else {
            $_SESSION['online'] = uniqid(); //pega um ID unico para a sessão
            $ip = $_SERVER['REMOTE_ADDR'];
            $token = $_SESSION['online'];
            $horarioAtual = date('Y-m-d H:i:s');
            $sql = MySql::conectar()->prepare("INSERT INTO `projeto_01`.`tb_admin.online` VALUES (null,?,?,?)");
            $sql->execute(array($ip, $horarioAtual, $token));
        }
    }

    public static function contador(){
        
        if(!isset($_COOKIE['visita'])){
            setcookie('visita','true',time() + (60*60*24*7));
            $sql = MySql::conectar()->prepare("INSERT INTO `projeto_01`.`tb_admin.visitas` VALUES (null,?,?)");
            $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
        }

        $contador = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_admin.visitas`");
        $contador->execute();
        return $visitasUnicas = $contador->rowCount();

    }

    public static function contadorHoje(){
        if(!isset($_COOKIE['visita'])){
            setcookie('visita','true', time() + (60*60*24*7));
            $sql = MySql::conectar()->prepare("INSERT INTO `projeto_01`.`tb_admin.visitas` VALUES (null,?,?)");
            $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
        }

        $contadorHoje = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_admin.visitas` WHERE dia = ?");
        $contadorHoje->execute(array(date('Y-m-d')));
        return $visitasHoje = $contadorHoje->rowCount();
    }
}
