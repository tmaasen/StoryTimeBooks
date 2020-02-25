package ui;

import java.util.Date;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

import model.Circuit;
import model.Toy;

public class Main {
    public static void main(String[] args) {
        EntityManagerFactory emf = Persistence.createEntityManagerFactory("TalkingSalesman");
        EntityManager em = emf.createEntityManager();

        Toy myToy = new Toy();
        myToy.setInspectionDateTime(new Date());
        myToy.setInspector("Tanner");
        myToy.setToyCode(648);
        Circuit myCircuit = new Circuit();
        myCircuit.setCircuitNumber(1);
        myCircuit.setManufactureLocation("USA");
        myCircuit.setVoltage(5);
        myCircuit.setResistance(100);
        myToy.addCircuit(myCircuit);
        em.getTransaction().begin();
        em.persist(myToy);
        em.getTransaction().commit();
    }
}