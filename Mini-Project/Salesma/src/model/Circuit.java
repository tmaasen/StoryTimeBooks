package model;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the Circuit database table.
 * 
 */
@Entity
@Table(name="Circuit")
@NamedQuery(name="Circuit.findAll", query="SELECT c FROM Circuit c")
public class Circuit implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="CircuitId")
	private int circuitId;

	@Column(name="Amperage")
	private double amperage;

	@Column(name="CircuitNumber")
	private int circuitNumber;

	@Column(name="ManufactureLocation")
	private String manufactureLocation;

	@Column(name="Resistance")
	private double resistance;

	@Column(name="Voltage")
	private double voltage;

	//bi-directional many-to-one association to Toy
	@ManyToOne
	@JoinColumn(name="ToyId")
	private Toy toy;

	public Circuit() {
	}

	public int getCircuitId() {
		return this.circuitId;
	}

	public void setCircuitId(int circuitId) {
		this.circuitId = circuitId;
	}

	public double getAmperage() {
		return this.amperage;
	}

	public void setAmperage(double amperage) {
		this.amperage = amperage;
	}

	public int getCircuitNumber() {
		return this.circuitNumber;
	}

	public void setCircuitNumber(int circuitNumber) {
		this.circuitNumber = circuitNumber;
	}

	public String getManufactureLocation() {
		return this.manufactureLocation;
	}

	public void setManufactureLocation(String manufactureLocation) {
		this.manufactureLocation = manufactureLocation;
	}

	public double getResistance() {
		return this.resistance;
	}

	public void setResistance(double resistance) {
		this.resistance = resistance;
	}

	public double getVoltage() {
		return this.voltage;
	}

	public void setVoltage(double voltage) {
		this.voltage = voltage;
	}

	public Toy getToy() {
		return this.toy;
	}

	public void setToy(Toy toy) {
		this.toy = toy;
	}

}