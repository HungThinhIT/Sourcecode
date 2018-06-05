import java.rmi.Remote;
import java.rmi.RemoteException;
import java.util.List;

public interface atmITF extends Remote{
	public void connectDB() throws RemoteException;
	public int checkmyID() throws RemoteException;
	public int checkmymoney() throws RemoteException;
	public int naptien(int inputmoney) throws RemoteException;
	public int ruttien(int outputmoney) throws RemoteException;
}
